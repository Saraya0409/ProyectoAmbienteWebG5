<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Eliminar producto
if (isset($_GET['eliminar'])) {
    $id_producto = $_GET['eliminar'];

    // Obtener y eliminar la imagen asociada
    $stmt = $conn->prepare("SELECT imagen FROM producto WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $stmt->bind_result($imagen);
    $stmt->fetch();
    $stmt->close();

    if ($imagen && file_exists($imagen)) {
        unlink($imagen);  // Eliminar la imagen del servidor
    }

    // Eliminar el producto de la base de datos
    $stmt = $conn->prepare("DELETE FROM producto WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Producto eliminado exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar el producto: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Obtener productos
$sql_productos = "SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.cantidad, c.nombre AS categoria_nombre, p.imagen 
                  FROM producto p
                  JOIN categoria c ON p.id_categoria = c.id_categoria";
$result_productos = $conn->query($sql_productos);

$productos = $result_productos->num_rows > 0 ? $result_productos->fetch_all(MYSQLI_ASSOC) : [];

// Obtener categorías
$sql_categorias = "SELECT id_categoria, nombre FROM categoria";
$result_categorias = $conn->query($sql_categorias);
$categorias = $result_categorias->num_rows > 0 ? $result_categorias->fetch_all(MYSQLI_ASSOC) : [];

$conn->close();  // Cerrar la conexión después de la consulta
?>

<?php include 'layout/nav.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Productos</h2>

        <!-- Botón para abrir el formulario modal -->
        <a href="#ProductoModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Producto</a>

        <!-- Formulario Modal para agregar Producto -->
        <div class="modal fade" id="ProductoModal" tabindex="-1" aria-labelledby="ProductoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ProductoModalLabel">Agregar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="agregar_producto.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select class="form-control" name="categoria" id="categoria" required>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?= $categoria['id_categoria']; ?>"><?= $categoria['nombre']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nombreProducto" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" required>
                            </div>
                            <div class="mb-3">
                                <label for="ProductoPrecio" class="form-label">Precio</label>
                                <input type="number" class="form-control" name="precio" id="ProductoPrecio" required>
                            </div>
                            <div class="mb-3">
                                <label for="ProductoCantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="ProductoCantidad" required>
                            </div>
                            <div class="mb-3">
                                <label for="ProductoImagen" class="form-label">Imagen</label>
                                <input type="file" class="form-control" name="imagen" id="ProductoImagen" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Productos -->
        <h3 class="mt-5 mb-3 text-center">Lista de Productos</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($productos): ?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= $producto['id_producto']; ?></td>
                            <td><img src="<?= $producto['imagen']; ?>" alt="<?= $producto['nombre']; ?>" style="width: 50px; height: 50px;"></td>
                            <td><?= $producto['categoria_nombre']; ?></td>
                            <td><?= $producto['nombre']; ?></td>
                            <td><?= $producto['descripcion']; ?></td>
                            <td><?= $producto['precio']; ?></td>
                            <td><?= $producto['cantidad']; ?></td>
                            <td>
                                <a href="editar_producto.php?editar=<?= $producto['id_producto']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="producto.php?eliminar=<?= $producto['id_producto']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center">No hay productos disponibles.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <?php include 'layout/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
