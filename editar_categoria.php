<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Verificar si se recibió un ID de categoría para editar
if (isset($_GET['editar'])) {
    $id_categoria = $_GET['editar'];

    // Obtener la categoría a editar
    $stmt = $conn->prepare("SELECT id_categoria, nombre FROM categoria WHERE id_categoria = ?");
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $categoria = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-warning'>Categoría no encontrada.</div>";
        exit();
    }
    $stmt->close();
}

// Procesar la solicitud de edición de la categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_categoria = $_POST['id_categoria'];
    $nombre = $_POST['nombreCategoria'];

    // Actualizar la categoría en la base de datos
    $stmt = $conn->prepare("UPDATE categoria SET nombre = ? WHERE id_categoria = ?");
    $stmt->bind_param("si", $nombre, $id_categoria);

    if ($stmt->execute()) {
        // Redirigir después de la actualización
        header("Location: categoria.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al actualizar la categoría: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();  // Cerrar la conexión
?>

<?php include 'layout/nav.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Editar Categoría</h2>

        <!-- Formulario para editar una categoría -->
        <form method="POST" action="">
            <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">

            <div class="mb-3">
                <label for="nombreCategoria" class="form-label">Nombre de la Categoría</label>
                <input type="text" class="form-control" name="nombreCategoria" id="nombreCategoria" value="<?php echo $categoria['nombre']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Actualizar Categoría</button>
        </form>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


