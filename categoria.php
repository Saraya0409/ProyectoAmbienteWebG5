<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation-->
    <?php include 'layout/nav.php'; ?>

    <!-- Contenido principal -->
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Categorías de Productos</h2>

        <!-- Formulario para agregar/actualizar categoría -->
        <form action="categorias.php" method="POST" class="mb-4">
            <input type="hidden" name="id" id="categoriaId">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre de la categoría" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="guardar">Guardar Categoría</button>
        </form>

        <!-- Listado de categorías -->
        <h3 class="mt-5 mb-3 text-center">Lista de Categorías</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categorias)): ?>
                    <?php foreach ($categorias as $categoria): ?>
                        <tr>
                            <td><?php echo $categoria['id']; ?></td>
                            <td><?php echo $categoria['nombre']; ?></td>
                            <td>
                                <!-- Botón Modificar -->
                                <button class="btn btn-warning btn-sm" onclick="editarCategoria('<?php echo $categoria['id']; ?>', '<?php echo $categoria['nombre']; ?>')">Modificar</button>
                                <!-- Botón Eliminar -->
                                <a href="categorias.php?eliminar=<?php echo $categoria['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No hay categorías disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <!-- Bootstrap JS y Script para manejar edición -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editarCategoria(id, nombre) {
            document.getElementById('categoriaId').value = id;
            document.getElementById('nombre').value = nombre;
        }
    </script>
</body>
</html>