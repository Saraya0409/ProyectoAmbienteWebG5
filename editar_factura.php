<?php
include 'db.php';  // Incluir la conexión a la base de datos

session_start(); // Iniciar sesión al principio

// Verificar si el parámetro 'editar' está presente en la URL
if (isset($_GET['editar'])) {
    $id_factura = $_GET['editar'];

    // Obtener los detalles de la factura a editar
    $stmt = $conn->prepare("SELECT * FROM factura WHERE id_factura = ?");
    $stmt->bind_param("i", $id_factura);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $factura = $resultado->fetch_assoc();
    $stmt->close();

    if (!$factura) {
        echo "<div class='alert alert-danger'>Factura no encontrada.</div>";
        exit;
    }

    // Procesar la actualización de la factura cuando el formulario se envía
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cedula = $_POST['cedulaFactura'];
        $nombre_cliente = $_POST['nombreCliente'];
        $telefono = $_POST['telefono'];
        $total = $_POST['total'];
        $metodo_pago = $_POST['metodoPago'];

        // Actualizar la factura en la base de datos
        $stmt = $conn->prepare("UPDATE factura SET cedula_cliente = ?, nombre_cliente = ?, telefono = ?, total = ?, metodo_pago = ? WHERE id_factura = ?");
        $stmt->bind_param("sssssi", $cedula, $nombre_cliente, $telefono, $total, $metodo_pago, $id_factura);

        if ($stmt->execute()) {
            // Redirigir a la página principal (factura.php) después de la actualización exitosa
            header("Location: factura.php");
            exit();  // Detener la ejecución después de la redirección
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar la factura: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }
}

$conn->close();  // Cerrar la conexión
?>

<?php include 'layout/nav.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="container my-5">
        <h2 class="mb-4 text-center">Editar Factura</h2>

        <!-- Formulario para editar la factura -->
        <form method="POST" action="editar_factura.php?editar=<?php echo $factura['id_factura']; ?>">
            <div class="mb-3">
                <label for="cedulaFactura" class="form-label">Cédula</label>
                <input type="text" class="form-control" name="cedulaFactura" id="cedulaFactura" value="<?php echo $factura['cedula_cliente']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" name="nombreCliente" id="nombreCliente" value="<?php echo $factura['nombre_cliente']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $factura['telefono']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" class="form-control" name="total" id="total" value="<?php echo $factura['total']; ?>" required step="0.01">
            </div>
            <div class="mb-3">
                <label for="metodoPago" class="form-label">Método de Pago</label>
                <select class="form-control" name="metodoPago" id="metodoPago" required>
                    <option value="Efectivo" <?php echo $factura['metodo_pago'] == 'Efectivo' ? 'selected' : ''; ?>>Efectivo</option>
                    <option value="Tarjeta" <?php echo $factura['metodo_pago'] == 'Tarjeta' ? 'selected' : ''; ?>>Tarjeta</option>
                    <option value="Sinpe" <?php echo $factura['metodo_pago'] == 'Sinpe' ? 'selected' : ''; ?>>Sinpe</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Actualizar Factura</button>
        </form>
    </section>

    <!-- Footer -->
    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

