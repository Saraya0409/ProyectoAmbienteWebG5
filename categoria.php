
<?php
include 'db.php';  // Incluir la conexión a la base de datos

// Eliminar categoría
if (isset($_GET['eliminar'])) {
    $id_categoria = $_GET['eliminar'];

    // Eliminar la categoría de la base de datos
    $stmt = $conn->prepare("DELETE FROM categoria WHERE id_categoria = ?");
    $stmt->bind_param("i", $id_categoria);

    if ($stmt->execute()) {
        // Redirigir para evitar reenvío de formulario al actualizar la página
        header("Location: categoria.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar la categoría: " . $stmt->error . "</div>";
    }

    $stmt->close();
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
    $categorias = [];
}

$conn->close();
?>

<?php include 'layout/nav.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Categorías</h2>

        <!-- Botón para abrir el formulario modal -->
        <li class="nav-item">
            <a href="#CategoriaModal" class="btn btn-primary mb-4" data-bs-toggle="modal">Agregar Categoría</a>
        </li>

        <!-- Formulario Modal para agregar Categoría -->
        <div class="modal fade" id="CategoriaModal" tabindex="-1" aria-labelledby="CategoriaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="CategoriaModalLabel">Agregar Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="agregar_categoria.php">
                            <div class="mb-3">
                                <label for="nombreCategoria" class="form-label">Nombre de la Categoría</label>
                                <input type="text" class="form-control" name="nombreCategoria" id="nombreCategoria" placeholder="Ingrese el nombre de la categoría" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Categoría</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Categorías -->
        <h3 class="mt-5 mb-3 text-center">Lista de Categorías</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID de Categoría</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($categorias)) {
                    foreach ($categorias as $categoria) {
                        echo "<tr>";
                        echo "<td>" . $categoria['id_categoria'] . "</td>";
                        echo "<td>" . $categoria['nombre'] . "</td>";
                        echo "<td>
                                <a href='editar_categoria.php?editar=" . $categoria['id_categoria'] . "' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='categoria.php?eliminar=" . $categoria['id_categoria'] . "' class='btn btn-danger btn-sm'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No hay categorías disponibles.</td></tr>";
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
