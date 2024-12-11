<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Eliminar producto
if (isset($_GET['eliminar'])) {
    $id_producto = $_GET['eliminar'];

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
$sql_productos = "SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.cantidad, c.nombre AS categoria_nombre 
                  FROM producto p
                  JOIN categoria c ON p.id_categoria = c.id_categoria";
$result_productos = $conn->query($sql_productos);

if ($result_productos->num_rows > 0) {
    $productos = [];
    while ($row = $result_productos->fetch_assoc()) {
        $productos[] = $row;
    }
} else {
    $productos = [];  // Si no hay productos, establecer un array vacío
}

// Obtener categorías
$sql_categorias = "SELECT id_categoria, nombre FROM categoria";
$result_categorias = $conn->query($sql_categorias);

if ($result_categorias->num_rows > 0) {
    $categorias = [];
    while ($row = $result_categorias->fetch_assoc()) {
        $categorias[] = $row;
    }
} else {
    echo "No hay categorías disponibles.";
}

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
        <li class="nav-item">
            <a href="#ProductoModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Producto</a>
        </li>

        <!-- Formulario Modal para agregar Producto -->
        <div class="modal fade" id="ProductoModal" tabindex="-1" aria-labelledby="ProductoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ProductoModalLabel">Agregar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="agregar_producto.php">
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría</label>
                                <select class="form-control" name="categoria" id="categoria" required>
                                    <?php
                                    foreach ($categorias as $categoria) {
                                        echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['nombre'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nombreProducto" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" placeholder="Ingrese el nombre del producto" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese la descripción del producto" required>
                            </div>
                            <div class="mb-3">
                                <label for="ProductoPrecio" class="form-label">Precio</label>
                                <input type="number" class="form-control" name="precio" id="ProductoPrecio" placeholder="Ingrese el precio del producto" required min="0" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="ProductoCantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" id="ProductoCantidad" placeholder="Ingrese la cantidad del producto" required min="1" step="1">
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
                    <th>ID de Producto</th>
                    <th>Categoría</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($productos)) {
                    foreach ($productos as $producto) {
                        echo "<tr>";
                        echo "<td>" . $producto['id_producto'] . "</td>";
                        echo "<td>" . $producto['categoria_nombre'] . "</td>";
                        echo "<td>" . $producto['nombre'] . "</td>";
                        echo "<td>" . $producto['descripcion'] . "</td>";
                        echo "<td>" . $producto['precio'] . "</td>";
                        echo "<td>" . $producto['cantidad'] . "</td>";
                        echo "<td>
                            <a href='editar_producto.php?editar=" . $producto['id_producto'] . "' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='producto.php?eliminar=" . $producto['id_producto'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No hay productos disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

