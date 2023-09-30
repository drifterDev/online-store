<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->
<?php if (isset($products) && isset($category)) : ?>
  <main class=" w-full">
    <div class="titulo">
      <h1>Productos de <?= $category->nombre ?></h1>
    </div>
    <?php if ($products->num_rows == 0) : ?>
      <div class="flex justify-center">
        <div class="alerta alerta-error my-5">No hay productos disponibles en esta categoría</div>
      </div>
    <?php else : ?>
      <div id="grid" class="grid grid-cols-2 lg:grid-cols-3">
        <?php while ($product =  $products->fetch_object()) : ?>
          <div class="product">
            <a href="../../product/show&id=<?= $product->id ?>" class="cursor-pointer hover:scale-95 transition-all">
              <div>
                <img src="../img/uploads/<?= $product->imagen ?>" alt="Imagen del producto">
              </div>
              <h2><?= $product->nombre ?></h2>
              <p><?= $product->precio ?> COP</p>
            </a>
            <a href="../../product/index" class="boton">Comprar</a>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </main>
<?php else : ?>
  <?php header("Location: ../../product/404") ?>
<?php endif; ?>