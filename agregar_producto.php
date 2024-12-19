<?php
include 'db.php'; // Incluir la conexión a la base de datos

// Procesar la solicitud de agregar un nuevo producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombreProducto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $id_categoria = $_POST['categoria'];

    // Manejar la imagen
    $imagen = $_FILES['imagen'];
    $ruta_imagen = '';

    if ($imagen['error'] === UPLOAD_ERR_OK) {
        $directorio = 'imagenes_productos/';
        $nombre_imagen = uniqid() . "_" . basename($imagen['name']);
        $ruta_imagen = $directorio . $nombre_imagen;

        // Crear el directorio si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        // Mover la imagen al directorio
        if (!move_uploaded_file($imagen['tmp_name'], $ruta_imagen)) {
            echo "<div class='alert alert-danger'>Error al subir la imagen.</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger'>Error al procesar la imagen.</div>";
        exit();
    }

    // Insertar el producto en la base de datos
    $stmt = $conn->prepare("INSERT INTO producto (nombre, descripcion, precio, cantidad, id_categoria, imagen) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiss", $nombre, $descripcion, $precio, $cantidad, $id_categoria, $ruta_imagen);

    if ($stmt->execute()) {
        header('Location: producto.php'); // Redirigir después de la inserción
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
}

$conn->close();
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
        <form method="POST" action="agregar_producto.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-control" name="categoria" id="categoria" required>
                    <option value="" disabled selected>Seleccione una categoría</option>
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
    </section>

    <?php include 'layout/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
