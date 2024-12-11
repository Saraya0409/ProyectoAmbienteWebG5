<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Verificar si el parámetro 'editar' está presente en la URL
if (isset($_GET['editar'])) {
    $id_producto = $_GET['editar'];

    // Obtener los detalles del producto a editar
    $stmt = $conn->prepare("SELECT * FROM producto WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();
    $stmt->close();

    if (!$producto) {
        echo "<div class='alert alert-danger'>Producto no encontrado.</div>";
        exit;
    }

    // Procesar la actualización del producto
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombreProducto'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $id_categoria = $_POST['categoria'];

        // Actualizar el producto
        $stmt = $conn->prepare("UPDATE producto SET nombre = ?, descripcion = ?, precio = ?, cantidad = ?, id_categoria = ? WHERE id_producto = ?");
        $stmt->bind_param("ssdiii", $nombre, $descripcion, $precio, $cantidad, $id_categoria, $id_producto);

        if ($stmt->execute()) {
            // Redirigir a la página de productos después de la actualización
            header("Location: producto.php");
            exit();  // Detener la ejecución después de la redirección
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar el producto: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }
}

// Obtener las categorías
$sql = "SELECT id_categoria, nombre FROM categoria";
$result = $conn->query($sql);
$categorias = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
} else {
    echo "<div class='alert alert-warning'>No hay categorías disponibles.</div>";
}

$conn->close();  // Cerrar la conexión
?>

<?php include 'layout/nav.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Editar Producto</h2>

        <!-- Formulario para editar el producto -->
        <form method="POST" action="editar_producto.php?editar=<?php echo $producto['id_producto']; ?>">
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-control" name="categoria" id="categoria" required>
                    <?php
                    foreach ($categorias as $categoria) {
                        $selected = ($categoria['id_categoria'] == $producto['id_categoria']) ? 'selected' : '';
                        echo "<option value='" . $categoria['id_categoria'] . "' $selected>" . $categoria['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nombreProducto" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" value="<?php echo $producto['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $producto['descripcion']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ProductoPrecio" class="form-label">Precio</label>
                <input type="number" class="form-control" name="precio" id="ProductoPrecio" value="<?php echo $producto['precio']; ?>" required min="0" step="0.01">
            </div>
            <div class="mb-3">
                <label for="ProductoCantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" id="ProductoCantidad" value="<?php echo $producto['cantidad']; ?>" required min="1" step="1">
            </div>
            <button type="submit" class="btn btn-primary w-100">Actualizar Producto</button>
        </form>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

