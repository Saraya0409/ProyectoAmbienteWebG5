<?php
include 'db.php'; // Conexión a la base de datos

// Manejar la eliminación de un envío
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_envio_id'])) {
    $id_envio = $_POST['eliminar_envio_id'];

    $stmt = $conn->prepare("DELETE FROM envio WHERE id_envio = ?");
    $stmt->bind_param("i", $id_envio);

    if ($stmt->execute()) {
        header('Location: crud_envios.php?mensaje=eliminado'); // Redirigir después de eliminar
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar el envío: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Obtener los datos de envíos
$sql = "SELECT id_envio, id_factura, cedula, nombre, direccion FROM envio";
$result = $conn->query($sql);
$envios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $envios[] = $row;
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
    <title>CRUD de Envíos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Administrar Envíos</h2>

        <!-- Modal para modificar envío -->
        <div class="modal fade" id="modificarEnvioModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modificar Envío</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST" action="crud_envios.php">
                        <div class="modal-body">
                            <input type="hidden" name="id_envio" id="editIdEnvio">
                            <div class="mb-3">
                                <label for="editNombreEnvio" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="editNombreEnvio" id="editNombreEnvio" required>
                            </div>
                            <div class="mb-3">
                                <label for="editDireccionEnvio" class="form-label">Dirección</label>
                                <textarea class="form-control" name="editDireccionEnvio" id="editDireccionEnvio" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabla para mostrar envíos -->
        <h3 class="mt-5 mb-3 text-center">Lista de Envíos</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Envío</th>
                    <th>ID Factura</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="envioTableBody">
                <?php foreach ($envios as $envio): ?>
                <tr>
                    <td><?= $envio['id_envio']; ?></td>
                    <td><?= $envio['id_factura']; ?></td>
                    <td><?= $envio['cedula']; ?></td>
                    <td><?= $envio['nombre']; ?></td>
                    <td><?= $envio['direccion']; ?></td>
                    <td>
                        <button 
                            class="btn btn-primary btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modificarEnvioModal"
                            onclick="cargarEnvio('<?= $envio['id_envio']; ?>', '<?= $envio['nombre']; ?>', '<?= $envio['direccion']; ?>')"
                        >
                            Modificar
                        </button>
                        <form method="POST" action="crud_envios.php" style="display: inline-block;">
                            <input type="hidden" name="eliminar_envio_id" value="<?= $envio['id_envio']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este envío?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    
    <?php include 'layout/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function cargarEnvio(id, nombre, direccion) {
            document.getElementById('editIdEnvio').value = id;
            document.getElementById('editNombreEnvio').value = nombre;
            document.getElementById('editDireccionEnvio').value = direccion;
        }
    </script>
</body>
</html>