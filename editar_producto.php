<?php
include 'db.php'; // Incluir la conexión a la base de datos

// Obtener el ID del producto a editar
if (isset($_GET['editar'])) {
    $id_producto = $_GET['editar'];

    // Obtener el producto
    $stmt = $conn->prepare("SELECT id_producto, nombre, descripcion, precio, cantidad, id_categoria, imagen FROM producto WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();

    // Obtener categorías
    $sql_categorias = "SELECT id_categoria, nombre FROM categoria";
    $result_categorias = $conn->query($sql_categorias);
    $categorias = $result_categorias->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombreProducto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $id_categoria = $_POST['categoria'];

    // Manejar la imagen
    $imagen = $_FILES['imagen'];
    $ruta_imagen = $producto['imagen'];

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
    }

    // Actualizar el producto en la base de datos
    $stmt = $conn->prepare("UPDATE producto SET nombre = ?, descripcion = ?, precio = ?, cantidad = ?, id_categoria = ?, imagen = ? WHERE id_producto = ?");
    $stmt->bind_param("ssdissi", $nombre, $descripcion, $precio, $cantidad, $id_categoria, $ruta_imagen, $id_producto);

    if ($stmt->execute()) {
        header('Location: producto.php'); // Redirigir después de la actualización
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar el producto: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
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

        <form method="POST" action="editar_producto.php?editar=<?= $producto['id_producto']; ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-control" name="categoria" id="categoria" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id_categoria']; ?>" <?= $categoria['id_categoria'] == $producto['id_categoria'] ? 'selected' : ''; ?>><?= $categoria['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nombreProducto" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" value="<?= $producto['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?= $producto['descripcion']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ProductoPrecio" class="form-label">Precio</label>
                <input type="number" class="form-control" name="precio" id="ProductoPrecio" value="<?= $producto['precio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ProductoCantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" id="ProductoCantidad" value="<?= $producto['cantidad']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ProductoImagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="imagen" id="ProductoImagen" accept="image/*">
                <small>Imagen actual: <img src="<?= $producto['imagen']; ?>" style="width: 50px; height: 50px;"></small>
            </div>
            <button type="submit" class="btn btn-warning w-100">Actualizar Producto</button>
        </form>
    </section>

    <?php include 'layout/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
