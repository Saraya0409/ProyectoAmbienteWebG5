<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation-->
    <?php include 'layout/nav.php'; ?>

    <!-- Contenido principal -->
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Productos</h2>

        <!-- Formulario para agregar/actualizar producto -->
        <form action="productos.php" method="POST" class="mb-4">
            <input type="hidden" name="id" id="productoId">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del producto" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese la cantidad" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese una descripción"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="guardar">Guardar Producto</button>
        </form>

        <!-- Listado de productos -->
        <h3 class="mt-5 mb-3 text-center">Lista de Productos</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto['id']; ?></td>
                            <td><?php echo $producto['nombre']; ?></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td><?php echo $producto['descripcion']; ?></td>
                            <td>
                                <!-- Botón Modificar -->
                                <button class="btn btn-warning btn-sm" onclick="editarProducto('<?php echo $producto['id']; ?>', '<?php echo $producto['nombre']; ?>', '<?php echo $producto['cantidad']; ?>', '<?php echo htmlspecialchars($producto['descripcion']); ?>')">Modificar</button>
                                <!-- Botón Eliminar -->
                                <a href="productos.php?eliminar=<?php echo $producto['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No hay productos disponibles</td>
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
        function editarProducto(id, nombre, cantidad, descripcion) {
            document.getElementById('productoId').value = id;
            document.getElementById('nombre').value = nombre;
            document.getElementById('cantidad').value = cantidad;
            document.getElementById('descripcion').value = descripcion;
        }
    </script>
</body>
</html>