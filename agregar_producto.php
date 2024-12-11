<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Procesar la solicitud de agregar un nuevo producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombreProducto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $id_categoria = $_POST['categoria'];

    // Insertar el producto en la base de datos
    $stmt = $conn->prepare("INSERT INTO producto (nombre, descripcion, precio, cantidad, id_categoria) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $cantidad, $id_categoria);

    if ($stmt->execute()) {
        // Redireccionar al archivo principal (producto.php) después de la inserción exitosa
        header('Location: producto.php');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al agregar el producto: " . $stmt->error . "</div>";
    }

    $stmt->close();
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
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Agregar Nuevo Producto</h2>

        <!-- Formulario para agregar un nuevo producto -->
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
            <button type="submit" class="btn btn-primary w-100">Agregar Producto</button>
        </form>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
