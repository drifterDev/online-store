<!-- Autor: Mateo Álvarez Murillo
Fecha de creación: 2023

Este código se proporciona bajo la Licencia MIT.
Para más información, consulta el archivo LICENSE en la raíz del repositorio. -->

<div class="w-full flex flex-col mt-5 items-center">
  <h1 class="text-xl font-medium text-center mb-5">Gestionar categorias</h1>
  <table class="mb-5 max-w-[30rem] w-full divide-y divide-gray-200">
    <thead>
      <tr>
        <th class="px-6 py-3 bg-gray-200 text-sm text-left leading-4 font-medium text-black uppercase tracking-wider">Id</th>
        <th class="px-6 py-3 bg-gray-200 text-sm text-left leading-4 font-medium text-black uppercase tracking-wider">Nombre</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-300">
      <?php while ($category = $categories->fetch_object()) : ?>
        <tr>
          <td class="px-6 py-4 whitespace-no-wrap">
            <?= $category->id ?>
          </td>
          <td class="px-6 py-4 whitespace-no-wrap">
            <?= $category->nombre ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <div class="flex flex-col md:flex-row w-full items-center md:justify-center">
    <a href="../../category/edit" class="md:mr-8 boton w-52 text-center">Editar categoría</a>
    <a href="../../category/create" class="boton w-52 text-center">Crear categoría</a>
  </div>
</div>